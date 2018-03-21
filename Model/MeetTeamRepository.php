<?php
    /**
     * MeetTeamRepository
     *
     * @copyright Copyright © 2018 Kinspeed Ltd. All rights reserved.
     * @author    luke.paoloni@kinspeed.com
     */
    
    
    namespace Kinspeed\MeetTeam\Model;

    use Kinspeed\MeetTeam\Model\TeamFactory;
    use Kinspeed\MeetTeam\Model\ResourceModel\Team\Collection as TeamCollectionFactory;
    use Kinspeed\MeetTeam\Api\Data\MeetTeamSearchResultInterface;
    use Kinspeed\MeetTeam\Api\Data\MeetTeamSearchResultInterfaceFactory;
    use Kinspeed\MeetTeam\Api\Data\MeetTeamInterface;
    use Kinspeed\MeetTeam\Api\MeetTeamRepositoryInterface;
    use Magento\Framework\Api\SearchCriteriaInterface;
    use Magento\Framework\Api\SortOrder;
    use Magento\Framework\Exception\NoSuchEntityException;

    class MeetTeamRepository implements MeetTeamRepositoryInterface
    {
    
        /**
         * @var \Kinspeed\MeetTeam\Model\TeamFactory
         */
        private $teamFactory;
        /**
         * @var \Kinspeed\MeetTeam\Model\ResourceModel\Team\Collection
         */
        private $teamCollection;
        /**
         * @var \Kinspeed\MeetTeam\Api\Data\MeetTeamSearchResultInterfaceFactory
         */
        private $teamSearchResultInterfaceFactory;
    
        /**
         * MeetTeamRepository constructor.
         *
         * @param \Kinspeed\MeetTeam\Model\MeetTeam                                $teamFactory
         * @param \Kinspeed\MeetTeam\Model\ResourceModel\Team\Collection           $teamCollection
         * @param \Kinspeed\MeetTeam\Api\Data\MeetTeamSearchResultInterfaceFactory $teamSearchResultInterfaceFactory
         */
        public function __construct (
            MeetTeam $teamFactory,
            TeamCollectionFactory $teamCollection,
            MeetTeamSearchResultInterfaceFactory $teamSearchResultInterfaceFactory
        )
        {
            $this->teamFactory = $teamFactory;
            $this->teamCollection = $teamCollection;
            $this->teamSearchResultInterfaceFactory = $teamSearchResultInterfaceFactory;
        }
    
        /**
         * @param int $id
         *
         * @return \Kinspeed\MeetTeam\Api\Data\MeetTeamInterface
         * @throws \Magento\Framework\Exception\NoSuchEntityException
         */
        public function getById ( $id )
        {
            $teamMember = $this->teamFactory->create();
            $teamMember->getResource()->load($teamMember, $id);
            if (!$teamMember->getId()) {
                throw new NoSuchEntityException(__('Unable to find Team Member with ID "%1"', $id));
            }
            return $teamMember;
        }
    
        /**
         * @param \Kinspeed\MeetTeam\Api\Data\MeetTeamInterface $team
         *
         * @return mixed
         */
        public function save ( MeetTeamInterface $team )
        {
            $team->getResource()->save($team);
            return $team;
        }
    
        /**
         * @param \Kinspeed\MeetTeam\Api\Data\MeetTeamInterface $team
         *
         * @return mixed
         */
        public function delete ( MeetTeamInterface $team )
        {
            $team->getResource()->delete($team);
        }
    
        /**
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
         *
         * @return mixed
         */
        public function getList ( SearchCriteriaInterface $searchCriteria )
        {
            $collection = $this->collectionFactory->create();
            
            $this->addFiltersToCollection($searchCriteria, $collection);
            $this->addSortOrdersToCollection($searchCriteria, $collection);
            $this->addPagingToCollection($searchCriteria, $collection);
            
            $collection->load();
            
            return $this->buildSearchResult($searchCriteria, $collection);
        }
    
        private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
        {
            foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
                $fields = $conditions = [];
                foreach ($filterGroup->getFilters() as $filter) {
                    $fields[] = $filter->getField();
                    $conditions[] = [$filter->getConditionType() => $filter->getValue()];
                }
                $collection->addFieldToFilter($fields, $conditions);
            }
        }
    
        private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
        {
            foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
                $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
                $collection->addOrder($sortOrder->getField(), $direction);
            }
        }
    
        private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
        {
            $collection->setPageSize($searchCriteria->getPageSize());
            $collection->setCurPage($searchCriteria->getCurrentPage());
        }
    
        private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
        {
            $searchResults = $this->searchResultFactory->create();
        
            $searchResults->setSearchCriteria($searchCriteria);
            $searchResults->setItems($collection->getItems());
            $searchResults->setTotalCount($collection->getSize());
        
            return $searchResults;
        }
    }
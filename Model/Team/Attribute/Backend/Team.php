<?php
/**
 * Team
 *
 * @copyright Copyright © 2017 Kinspeed. All rights reserved.
 * @author    luke.paoloni@kinspeed.com
 */

namespace Kinspeed\MeetTeam\Model\Team\Attribute\Backend;

use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Framework\DataObject;
use Kinspeed\MeetTeam\Helper\FileProcessor;

class Team extends AbstractBackend
{
    /**
     * @var string
     */
    const FILES_SUBDIR = 'team';

    /**
     * @var FileProcessor
     */
    protected $fileProcessor;

    /**
     * @param FileProcessor $fileProcessor
     */
    public function __construct(FileProcessor $fileProcessor)
    {
        $this->fileProcessor = $fileProcessor;
    }

    /**
     * Prepare File data before saving object
     *
     * @param \Magento\Framework\DataObject $object
     *
     * @return $this
     * @throws \Exception
     */
    public function beforeSave($object) //@codingStandardsIgnoreLine
    {
        parent::beforeSave($object);
        $file = $object->getTeam();
        if (!is_array($file)) {
            $object->setSkipSaveTeam(true);
            return $this;
        }

        if (isset($file['delete'])) {
            $object->setTeam(null);
            return $this;
        }

        $file = reset($file) ?: [];
        if (!isset($file['file'])) {
            throw new LocalizedException(
                __('Team member does not contain field \'file\'')
            );
        }
        // Add file related data to object
        $object->setTeam($file['file']);
        $object->setFileExists(isset($file['exists']));

        return $this;
    }

    /**
     * Save uploaded file and remove temporary file after saving object
     *
     * @param \Magento\Framework\DataObject $object
     *
     * @return $this
     * @throws \Exception
     */
    public function afterSave($object) //@codingStandardsIgnoreLine
    {
        parent::afterSave($object);
        // if file already exists we do not need to save any new file
        if ($object->getFileExists() || $object->getSkipSaveTeam()) {
            return $this;
        }

        // Delete old file if new one has changed
        if ($object->getOrigData('team') && $object->getTeam() != $object->getOrigData('team')) {
            $this->fileProcessor->delete($this->getFileSubDir($object), $object->getOrigData('team'));
        }

        if ($object->getTeam()) {
            if (!$this->fileProcessor->saveFileFromTmp($object->getTeam(), $this->getFileSubDir($object))) {
                throw new \Exception('There was an error saving the file');
            }
        }
    }

    /**
     * Subdir where files are stored
     *
     * @param \Magento\Framework\DataObject $object
     * @return string
     */
    protected function getFileSubDir($object)
    {
        return self::FILES_SUBDIR . '/' . $object->getId();
    }

    /**
     * Delete media file before an team row in database is removed
     * @param \Magento\Framework\DataObject $object
     * @return $this
     */
    public function beforeDelete($object) //@codingStandardsIgnoreLine
    {
        parent::beforeDelete($object);
        // Delete file from disk before the object is deleted from database
        if ($object->getTeam()) {
            $this->fileProcessor->delete($this->getFileSubDir($object), $object->getTeam());
        }
        return $this;
    }

    /**
     * Get full info from file
     *
     * @param \Magento\Framework\DataObject $object
     * @return DataObject
     */
    public function getFileInfo($object)
    {
        if (!$object->getData('file_info') && $object->getTeam()) {
            $fileInfoObject = new DataObject();
            $fileInfo = $this->fileProcessor->getFileInfo($object->getTeam(), $this->getFileSubDir($object));
            if ($fileInfo) {
                $fileInfoObject->setData($fileInfo);
            }
            $object->setFileInfo($fileInfoObject);
        }

        return $object->getData('file_info');
    }
    /**
     * Get full name
     *
     * @param \Magento\Framework\DataObject $object
     * @return DataObject
     */
    public function getName($object)
    {
        return $object->getData('full_name');
    }
    
    /**
     * Get about me
     *
     * @param \Magento\Framework\DataObject $object
     * @return DataObject
     */
    public function getAboutMe($object)
    {
        return $object->getData('about_me');
    }
    
    /**
     * Get job title
     *
     * @param \Magento\Framework\DataObject $object
     * @return DataObject
     */
    public function getJobTitle($object)
    {
        return $object->getData('job_title');
    }

    /**
     * Return file info in a format valid for ui form fields
     *
     * @param \Magento\Framework\DataObject $object
     * @return array
     */
    public function getFileValueForForm($object)
    {
        if ($this->getFileInfo($object)->getFile()) {
            return [$this->getFileInfo($object)->getData()];
        }
        return [];
    }
}

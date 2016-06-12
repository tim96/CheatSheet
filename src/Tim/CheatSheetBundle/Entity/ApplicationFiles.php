<?php

namespace Tim\CheatSheetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ApplicationFiles
 *
 * @ORM\Table(name="application_files")
 * @ORM\Entity(repositoryClass="Tim\CheatSheetBundle\Repository\ApplicationFilesRepository")
 * @ORM\HasLifecycleCallbacks
 *
 */
class ApplicationFiles
{

    const PATH_APPLICATION_FILES = '/uploads/applications';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", options={"default": 0} )
     */
    private $type;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     *
     * @ORM\Column(name="version", type="string", length=255)
     */
    private $version;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     *
     * @ORM\Column(name="created_at", type="datetime")
     **/
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     *
     * @ORM\Column(name="updated_at", type="datetime")
     **/
    private $updatedAt;

    /**
     * @var File
     *
     * @Assert\File(maxSize = "25072k")
     *
     * @ORM\Column(name="application_file", type="string", length=512, nullable=false)
     */
    private $applicationFile;

    /**
     * Application file path
     *
     * @var string
     *
     * @ORM\Column(name="application_path", type="string", length=255, nullable=false)
     */
    protected $applicationPath;

    /**
     * Application file size
     *
     * @var string
     *
     * @ORM\Column(name="application_size", type="string", length=255, nullable=true)
     */
    protected $applicationSize;

    /**
     * @ORM\ManyToOne(targetEntity="Application", inversedBy="files")
     * @ORM\JoinColumn(name="application_id", referencedColumnName="id", nullable=false)
     */
    private $application;

    public function __construct()
    {
        $this->type = 0;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function __toString()
    {
        return $this->id ? (string)$this->version : '';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->applicationFile) {
//            $filename = hash('sha512', uniqid(mt_rand(), true));
            $filename = sha1(uniqid(mt_rand(), true));
            $this->applicationPath = $filename.'.'.$this->applicationFile->getExtension();
        }
    }

    /**
     * @ORM\PreRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getUploadPath()) {
            unlink($file);
        }
    }

    protected function getUploadPath()
    {
        return $this->getUploadRootDir() . DIRECTORY_SEPARATOR . $this->applicationPath;
    }

    protected function getUploadRootDir()
    {
        return WEB_DIRECTORY . self::PATH_APPLICATION_FILES;
    }

    /**
     * Called after entity persistence
     *
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     *
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     */
    public function upload()
    {
        if (null === $this->applicationFile) {
            return;
        }

        $this->applicationFile->move(
            $this->getUploadRootDir(),
            $this->applicationPath
        );

        $this->applicationSize = $this->calcFileSize($this->getUploadPath());

        $this->applicationFile = null;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param int $type
     *
     * @return ApplicationFiles
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set version
     *
     * @param string $version
     *
     * @return ApplicationFiles
     */
    public function setVersion($version)
    {
        $this->version = $version;
    
        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ApplicationFiles
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return ApplicationFiles
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set applicationFile
     *
     * @param string $applicationFile
     *
     * @return ApplicationFiles
     */
    public function setApplicationFile($applicationFile)
    {
        $this->applicationFile = $applicationFile;
    
        return $this;
    }

    /**
     * Get applicationFile
     *
     * @return string
     */
    public function getApplicationFile()
    {
        if (null !== $this->applicationPath && $file = $this->getUploadPath()) {
            return file_get_contents($file);
        }

        return $this->applicationFile;
    }

    /**
     * Set applicationPath
     *
     * @param string $applicationPath
     *
     * @return ApplicationFiles
     */
    public function setApplicationPath($applicationPath)
    {
        $this->applicationPath = $applicationPath;
    
        return $this;
    }

    /**
     * Get applicationPath
     *
     * @return string
     */
    public function getApplicationPath()
    {
        return $this->applicationPath;
    }

    /**
     * Set applicationSize
     *
     * @param string $applicationSize
     *
     * @return ApplicationFiles
     */
    public function setApplicationSize($applicationSize)
    {
        $this->applicationSize = $applicationSize;
    
        return $this;
    }

    /**
     * Get applicationSize
     *
     * @return string
     */
    public function getApplicationSize()
    {
        return $this->applicationSize;
    }

    /**
     * Set application
     *
     * @param \Tim\CheatSheetBundle\Entity\Application $application
     *
     * @return ApplicationFiles
     */
    public function setApplication(\Tim\CheatSheetBundle\Entity\Application $application = null)
    {
        $this->application = $application;
    
        return $this;
    }

    /**
     * Get application
     *
     * @return \Tim\CheatSheetBundle\Entity\Application
     */
    public function getApplication()
    {
        return $this->application;
    }

    private function calcFileSize($path)
    {
        $size = filesize($path);
        $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }
}

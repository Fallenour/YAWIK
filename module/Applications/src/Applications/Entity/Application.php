<?php

namespace Applications\Entity;

use Core\Entity\AbstractIdentifiableEntity;
use Core\Entity\EntityInterface;

/**
 * @todo write interface
 * @author mathias
 *
 */
class Application extends AbstractIdentifiableEntity implements ApplicationInterface
{
    protected $jobId;
    protected $job;
    
    /*
     * new
     */
    protected $status;
    protected $dateCreated;
    protected $dateModified;

    /*
     * personal informations, contains firstname, lastname, email, 
     * phone etc.
     */
    protected $contact;
    
    /*
     * Resume, containing employments, educations and skills
     */
    protected $cv;

    
    
    /**
     * @return the $jobId
     */
    public function getJobId ()
    {
        if (!$this->jobId && ($job = $this->getJob())) {
            $this->setJobId($job->getId());
        }
        return $this->jobId;
    }

	/**
     * @param field_type $jobId
     */
    public function setJobId ($jobId)
    {
        $this->jobId = $jobId;
    }
    
    public function getJob()
    {
        return $this->job;
    }
    
    public function injectJob(EntityInterface $job)
    {
        $this->job = $job;
        $this->setJobId($job->getId());
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
    
    public function getStatus()
    {
        return $this->status;
    }
    
    public function getDateCreated ($format=null)
    {
        if (!$this->dateCreated) {
            $this->setDateCreated('now');
        }
        return null !== $format
            ? strftime($format, $this->dateCreated->getTimestamp())
            : $this->dateCreated;
    }
    
    public function setDateCreated ($dateCreated)
    {
        if (is_string($dateCreated)) {
            $dateCreated = new \DateTime($dateCreated);
        }
        
        if (!$dateCreated instanceOf \DateTime) {
            $dateCreated = new \DateTime();
        }
        
        $this->dateCreated = $dateCreated;
    }
    
    public function getDateModified ($format=null)
    {
        if (!$this->dateModified) {
            $this->setDateModified('now');
        }
        return null !== $format
            ? $this->dateModified->format($format)
            : $this->dateModified;
    }
    
    public function setDateModified ($dateModified)
    {
        if (is_string($dateModified)) {
            $dateCreated = new \DateTime($dateModified);
        }
    
        if (!$dateModified instanceOf \DateTime) {
            $dateModified = new \DateTime();
        }
    
        $this->dateModified = $dateModified;
    }
    
	/**
     * @return the $contact
     */
    public function getContact ()
    {
        return $this->contact;
    }

	/**
     * @param field_type $contact
     */
    public function setContact (EntityInterface $contact)
    {
        $this->contact = $contact;
        return $this;
    }

	public function setCv(EntityInterface $cv)
	{
	    $this->cv = $cv;
	    return $this;
	}
	
	public function getCv()
	{
	    return $this->cv;
	}
}
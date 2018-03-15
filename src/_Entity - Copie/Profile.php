<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profile
 *
 * @ORM\Table(name="profile")
 * @ORM\Entity
 */
class Profile
{
    /**
     * @var string
     *
     * @ORM\Column(name="profile_firstname", type="string", length=255, nullable=true)
     */
    private $profileFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="profile_name", type="string", length=255, nullable=true)
     */
    private $profileName;

    /**
     * @var string
     *
     * @ORM\Column(name="profile_avatar", type="string", length=255, nullable=true)
     */
    private $profileAvatar;

    /**
     * @var integer
     *
     * @ORM\Column(name="profile_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $profileId;



    /**
     * Set profileFirstname
     *
     * @param string $profileFirstname
     *
     * @return Profile
     */
    public function setProfileFirstname($profileFirstname)
    {
        $this->profileFirstname = $profileFirstname;
    
        return $this;
    }

    /**
     * Get profileFirstname
     *
     * @return string
     */
    public function getProfileFirstname()
    {
        return $this->profileFirstname;
    }

    /**
     * Set profileName
     *
     * @param string $profileName
     *
     * @return Profile
     */
    public function setProfileName($profileName)
    {
        $this->profileName = $profileName;
    
        return $this;
    }

    /**
     * Get profileName
     *
     * @return string
     */
    public function getProfileName()
    {
        return $this->profileName;
    }

    /**
     * Set profileAvatar
     *
     * @param string $profileAvatar
     *
     * @return Profile
     */
    public function setProfileAvatar($profileAvatar)
    {
        $this->profileAvatar = $profileAvatar;
    
        return $this;
    }

    /**
     * Get profileAvatar
     *
     * @return string
     */
    public function getProfileAvatar()
    {
        return $this->profileAvatar;
    }

    /**
     * Get profileId
     *
     * @return integer
     */
    public function getProfileId()
    {
        return $this->profileId;
    }
}

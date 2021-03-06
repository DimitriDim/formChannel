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
     * @var int
     *
     * @ORM\Column(name="profile_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $profileId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="profile_firstname", type="string", length=255, nullable=true)
     */
    private $profileFirstname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="profile_name", type="string", length=255, nullable=true)
     */
    private $profileName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="profile_avatar", type="string", length=255, nullable=true)
     */
    private $profileAvatar;



    /**
     * Get profileId.
     *
     * @return int
     */
    public function getProfileId()
    {
        return $this->profileId;
    }

    /**
     * Set profileFirstname.
     *
     * @param string|null $profileFirstname
     *
     * @return Profile
     */
    public function setProfileFirstname($profileFirstname = null)
    {
        $this->profileFirstname = $profileFirstname;
    
        return $this;
    }

    /**
     * Get profileFirstname.
     *
     * @return string|null
     */
    public function getProfileFirstname()
    {
        return $this->profileFirstname;
    }

    /**
     * Set profileName.
     *
     * @param string|null $profileName
     *
     * @return Profile
     */
    public function setProfileName($profileName = null)
    {
        $this->profileName = $profileName;
    
        return $this;
    }

    /**
     * Get profileName.
     *
     * @return string|null
     */
    public function getProfileName()
    {
        return $this->profileName;
    }

    /**
     * Set profileAvatar.
     *
     * @param string|null $profileAvatar
     *
     * @return Profile
     */
    public function setProfileAvatar($profileAvatar = null)
    {
        $this->profileAvatar = $profileAvatar;
    
        return $this;
    }

    /**
     * Get profileAvatar.
     *
     * @return string|null
     */
    public function getProfileAvatar()
    {
        return $this->profileAvatar;
    }
}

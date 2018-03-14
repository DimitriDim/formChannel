<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Channel
 *
 * @ORM\Table(name="channel", indexes={@ORM\Index(name="profile_id", columns={"profile_id"})})
 * @ORM\Entity
 */
class Channel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="channel_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $channelId;

    /**
     * @var string
     *
     * @ORM\Column(name="channel_name", type="string", length=255, nullable=false)
     */
    private $channelName;

    /**
     * @var string
     *
     * @ORM\Column(name="channel_descr", type="string", length=255, nullable=false)
     */
    private $channelDescr;

    /**
     * @var integer
     *
     * @ORM\Column(name="channel_capacity", type="integer", nullable=false)
     */
    private $channelCapacity;

    /**
     * @var \App\Entity\Profile
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Profile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profile_id", referencedColumnName="profile_id")
     * })
     */
    private $profile;



    /**
     * Get channelId
     *
     * @return integer
     */
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * Set channelName
     *
     * @param string $channelName
     *
     * @return Channel
     */
    public function setChannelName($channelName)
    {
        $this->channelName = $channelName;
    
        return $this;
    }

    /**
     * Get channelName
     *
     * @return string
     */
    public function getChannelName()
    {
        return $this->channelName;
    }

    /**
     * Set channelDescr
     *
     * @param string $channelDescr
     *
     * @return Channel
     */
    public function setChannelDescr($channelDescr)
    {
        $this->channelDescr = $channelDescr;
    
        return $this;
    }

    /**
     * Get channelDescr
     *
     * @return string
     */
    public function getChannelDescr()
    {
        return $this->channelDescr;
    }

    /**
     * Set channelCapacity
     *
     * @param integer $channelCapacity
     *
     * @return Channel
     */
    public function setChannelCapacity($channelCapacity)
    {
        $this->channelCapacity = $channelCapacity;
    
        return $this;
    }

    /**
     * Get channelCapacity
     *
     * @return integer
     */
    public function getChannelCapacity()
    {
        return $this->channelCapacity;
    }

    /**
     * Set profile
     *
     * @param \App\Entity\Profile $profile
     *
     * @return Channel
     */
    public function setProfile(\App\Entity\Profile $profile = null)
    {
        $this->profile = $profile;
    
        return $this;
    }

    /**
     * Get profile
     *
     * @return \App\Entity\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }
}

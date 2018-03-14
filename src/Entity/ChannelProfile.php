<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChannelProfile
 *
 * @ORM\Table(name="channel_profile", indexes={@ORM\Index(name="channel_id", columns={"channel_id"}), @ORM\Index(name="profile_id", columns={"profile_id"})})
 * @ORM\Entity
 */
class ChannelProfile
{
    /**
     * @var integer
     *
     * @ORM\Column(name="channel_profile_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $channelProfileId;

    /**
     * @var \App\Entity\Channel
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Channel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="channel_id", referencedColumnName="channel_id")
     * })
     */
    private $channel;

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
     * Get channelProfileId
     *
     * @return integer
     */
    public function getChannelProfileId()
    {
        return $this->channelProfileId;
    }

    /**
     * Set channel
     *
     * @param \App\Entity\Channel $channel
     *
     * @return ChannelProfile
     */
    public function setChannel(\App\Entity\Channel $channel = null)
    {
        $this->channel = $channel;
    
        return $this;
    }

    /**
     * Get channel
     *
     * @return \App\Entity\Channel
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set profile
     *
     * @param \App\Entity\Profile $profile
     *
     * @return ChannelProfile
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

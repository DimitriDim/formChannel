<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChannelProfile
 *
 * @ORM\Table(name="channel_profile", uniqueConstraints={@ORM\UniqueConstraint(name="channel_id_2", columns={"channel_id", "profile_id"})}, indexes={@ORM\Index(name="channel_id", columns={"channel_id"}), @ORM\Index(name="profile_id", columns={"profile_id"})})
 * @ORM\Entity
 */
class ChannelProfile
{
    /**
     * @var int
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
     * Get channelProfileId.
     *
     * @return int
     */
    public function getChannelProfileId()
    {
        return $this->channelProfileId;
    }

    /**
     * Set channel.
     *
     * @param \App\Entity\Channel|null $channel
     *
     * @return ChannelProfile
     */
    public function setChannel(\App\Entity\Channel $channel = null)
    {
        $this->channel = $channel;
    
        return $this;
    }

    /**
     * Get channel.
     *
     * @return \App\Entity\Channel|null
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set profile.
     *
     * @param \App\Entity\Profile|null $profile
     *
     * @return ChannelProfile
     */
    public function setProfile(\App\Entity\Profile $profile = null)
    {
        $this->profile = $profile;
    
        return $this;
    }

    /**
     * Get profile.
     *
     * @return \App\Entity\Profile|null
     */
    public function getProfile()
    {
        return $this->profile;
    }
}

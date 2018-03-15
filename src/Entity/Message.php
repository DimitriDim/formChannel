<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message", indexes={@ORM\Index(name="profile_id", columns={"profile_id"}), @ORM\Index(name="channel_id", columns={"channel_id"})})
 * @ORM\Entity
 */
class Message
{
    /**
     * @var int
     *
     * @ORM\Column(name="message_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $messageId;

    /**
     * @var string
     *
     * @ORM\Column(name="message_text", type="string", length=255, nullable=false)
     */
    private $messageText;

    /**
     * @var int
     *
     * @ORM\Column(name="timestamp", type="integer", nullable=false)
     */
    private $timestamp;

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
     * @var \App\Entity\Channel
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Channel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="channel_id", referencedColumnName="channel_id")
     * })
     */
    private $channel;



    /**
     * Get messageId.
     *
     * @return int
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * Set messageText.
     *
     * @param string $messageText
     *
     * @return Message
     */
    public function setMessageText($messageText)
    {
        $this->messageText = $messageText;
    
        return $this;
    }

    /**
     * Get messageText.
     *
     * @return string
     */
    public function getMessageText()
    {
        return $this->messageText;
    }

    /**
     * Set timestamp.
     *
     * @param int $timestamp
     *
     * @return Message
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    
        return $this;
    }

    /**
     * Get timestamp.
     *
     * @return int
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set profile.
     *
     * @param \App\Entity\Profile|null $profile
     *
     * @return Message
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

    /**
     * Set channel.
     *
     * @param \App\Entity\Channel|null $channel
     *
     * @return Message
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
}

<?php
/**
 *
 * Created by PhpStorm.
 * User: Rozmetov Jasur ( @rozmetovjasur )
 * Date: 03/08/21
 * Time: 10:20
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaymentRepository")
 * @ORM\Table()
 */
class Payment
{

    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @var float
     * @ORM\Column(name="amount", type="decimal", scale=2, precision = 10, nullable=false)
     */
    private float $amount = 0;

    /**
     * @var \DateTime
     * @ORM\Column(name="time", type="datetime", nullable=false)
     */
    private \DateTime $time;

    /**
     * @var PaymentMethod
     * @ORM\ManyToOne(targetEntity="App\Entity\PaymentMethod")
     * @ORM\JoinColumn(name="method_id", referencedColumnName="id", nullable=false)
     */
    private PaymentMethod $method;

    private string $note;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     */
    public function setTime(\DateTime $time): void
    {
        $this->time = $time;
    }

    /**
     * @return PaymentMethod
     */
    public function getMethod(): PaymentMethod
    {
        return $this->method;
    }

    /**
     * @param PaymentMethod $method
     */
    public function setMethod(PaymentMethod $method): void
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote(string $note): void
    {
        $this->note = $note;
    }

}
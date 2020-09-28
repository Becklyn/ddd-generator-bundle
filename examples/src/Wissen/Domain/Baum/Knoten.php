<?php

namespace App\Wissen\Domain\Baum;

use C201\Ddd\Events\Domain\EventProvider;
use C201\Ddd\Events\Domain\EventProviderCapabilities;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="wissen_knoten")
 */
class Knoten implements EventProvider
{
    use EventProviderCapabilities;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $internalId = null;

    /**
     * @ORM\Column(type="string", unique=true, length=36, nullable=false, name="uuid")
     */
    private string $id;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=false)
     * @Gedmo\Timestampable(on="create")
     */
    private ?\DateTimeImmutable $createdTs = null;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=false)
     * @Gedmo\Timestampable(on="update")
     */
    private ?\DateTimeImmutable $updatedTs = null;

    public static function erzeugen(
        KnotenId $id
    ): self {
        // TODO add additional properties

        $knoten = new static($id);
        $knoten->raiseEvent(
            new KnotenErzeugt(
                $knoten->nextEventIdentity(),
                new \DateTimeImmutable(),
                $id
            )
        );
        return $knoten;
    }

    private function __construct(KnotenId $id)
    {
        // TODO add additional properties

        $this->id = $id->asString();
    }

    public function id(): KnotenId
    {
        return KnotenId::fromString($this->id);
    }
}

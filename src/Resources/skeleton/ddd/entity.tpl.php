<?= "<?php declare(strict_types=1);\n"; ?>

namespace <?= $namespace; ?>;

use C201\Ddd\Events\Domain\EventProvider;
use C201\Ddd\Events\Domain\EventProviderCapabilities;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @author <?= $author; ?><?= "\n"; ?>
 *
 * @since <?= $version; ?><?= "\n"; ?>
 *
 * @ORM\Entity
 * @ORM\Table(name="<?= \strtolower($domain); ?>_<?= \strtolower($entity); ?>")
 */
class <?= $class_name; ?> implements EventProvider
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

    /**
     * Factory method that generates a new entity and raises a event if the entity was generated.
     */
    public static function <?= $i18n["_generate"]; ?> (<?= $entity; ?>Id $id) : self
    {
        // TODO add additional properties

        $<?= \strtolower($entity); ?> = new static($id);
        $<?= \strtolower($entity); ?>->raiseEvent(
            new <?= $entity; ?><?= $i18n["generated"]; ?>(
                $<?= \strtolower($entity); ?>->nextEventIdentity(),
                new \DateTimeImmutable(),
                $id
            )
        );

        return $<?= \strtolower($entity); ?>;
    }

    private function __construct (<?= $entity; ?>Id $id)
    {
        // TODO add additional properties

        $this->id = $id->asString();
    }

    public function id () : <?= $entity; ?>Id
    {
        return <?= $entity; ?>Id::fromString($this->id);
    }
}

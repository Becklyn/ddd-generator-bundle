<?= "<?php declare(strict_types=1);\n"; ?>

namespace <?= $namespace; ?>;

use Becklyn\Ddd\Events\Domain\EventProvider;
use Becklyn\Ddd\Events\Domain\EventProviderCapabilities;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author <?= $author; ?><?= "\n"; ?>
 *
 * @since <?= $version; ?><?= "\n"; ?>
 */
#[Orm\Entity]
#[Orm\Table(name: "<?= $strtosnake($domain); ?>_<?= $strtosnake($entity); ?>s")]
// @todo Check table name "<?= $strtosnake($domain); ?>_<?= $strtosnake($entity); ?>s" for grammar.
class <?= $class_name; ?> implements EventProvider
{
    use EventProviderCapabilities;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id", type: "integer", options: ["unsigned" => true])]
    private ?int $internalId = null;

    #[ORM\Column(name: "uuid", type: "string", length: 36, unique: true, nullable: false)]
    private string $id;

    #[ORM\Column(type: "datetime_immutable", nullable: false, columnDefinition: "DATETIME(6) NOT NULL COMMENT '(DC2Type:datetime_immutable)' DEFAULT CURRENT_TIMESTAMP(6)")]
    private \DateTimeImmutable $createdTs;

    #[ORM\Column(type: "datetime_immutable", nullable: false, columnDefinition: "DATETIME(6) NOT NULL COMMENT '(DC2Type:datetime_immutable)' DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)")]
    private \DateTimeImmutable $updatedTs;

    /**
     * Factory method that generates a new entity and raises a event if the entity was created.
     */
    public static function <?= $i18n["_create"]; ?> (<?= $entity; ?>Id $id) : self
    {
        // TODO add additional properties

        $<?= $strtocamel($entity); ?> = new static($id);
        $<?= $strtocamel($entity); ?>->raiseEvent(
            new <?= $entity; ?><?= $i18n["created"]; ?>(
                $<?= $strtocamel($entity); ?>->nextEventIdentity(),
                new \DateTimeImmutable(),
                $id
            )
        );

        return $<?= $strtocamel($entity); ?>;
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

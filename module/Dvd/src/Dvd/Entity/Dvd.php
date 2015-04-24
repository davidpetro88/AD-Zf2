<?php
namespace Dvd\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as Form;
use LosBase\Entity\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="dvd")
 * @Form\Name("formDvd")
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Type("LosBase\Form\AbstractForm")
 */
class Dvd extends AbstractEntity
{

    /**
     * @ORM\Column(type="string", length=250)
     */
    protected $nome;

    /**
     *
     * @return the $nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     *
     * @param field_type $nome            
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
}

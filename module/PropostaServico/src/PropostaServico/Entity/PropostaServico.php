<?php
namespace PropostaServico\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as Form;
use AcploBase\Entity\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="proposta-servico")
 * @Form\Name("formPropostaServico")
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Type("AcploBase\Form\AbstractForm")
 */
class PropostaServico extends AbstractEntity
{
    
    /**
     * @ORM\ManyToOne(targetEntity="Cliente\Entity\Cliente", inversedBy="intervalos")
     * @ORM\JoinColumn(nullable=false, onDelete="RESTRICT")
     */
    protected $cliente;
    
    /**
     * @ORM\Column(type="brprice")
     */
    protected $valor;
    
    /**
     * @ORM\Column(type="string", length=256)
     */
    protected $descricao;
    
    public function __construct()
    {
        $this->created = new \DateTime('now');
        $this->updated = new \DateTime('now');
    }
}

<?php
namespace Servico\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as Form;
use LosBase\Entity\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="servico")
 * @Form\Name("formServico")
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Type("LosBase\Form\AbstractForm")
 */
class Servico extends AbstractEntity
{

    /**
     * @ORM\Column(type="string", length=250)
     * @Form\Options({"label":"Nome Serviço"})
     * @Form\Type("text")
     */
    protected $nome;

    /**
     * @ORM\Column(type="brprice")
     * @Form\Options({"label":"Valor Serviço"})
     * @Form\Type("text")
     */
    protected $valor;

    /**
     * @ORM\Column(type="brprice")
     * @Form\Options({"label":"Custo Serviço"})
     * @Form\Type("text")
     */
    protected $custo;

    public function __construct()
    {
        $this->created = new \DateTime('now');
        $this->updated = new \DateTime('now');
    }

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
     * @return the $valor
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     *
     * @return the $custo
     */
    public function getCusto()
    {
        return $this->custo;
    }

    /**
     *
     * @param field_type $nome            
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     *
     * @param field_type $valor            
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     *
     * @param field_type $custo            
     */
    public function setCusto($custo)
    {
        $this->custo = $custo;
    }
}

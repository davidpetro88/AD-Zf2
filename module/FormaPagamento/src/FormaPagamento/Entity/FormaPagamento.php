<?php
namespace FormaPagamento\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as Form;
use LosBase\Entity\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="forma_pagamento")
 * @Form\Name("formForma_Pagamento")
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Type("LosBase\Form\AbstractForm")
 */
class FormaPagamento extends AbstractEntity
{

    /**
     * @ORM\Column(type="string", length=250)
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":4, "max":250}})
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Nome"})
     */
    protected $nome;

    /**
     * @ORM\Column(type="boolean")
     * @Form\Type("Zend\Form\Element\Select")
     * @Form\Options({"label":"Habilitar","value_options":{
     * "":"SELECIONE",
     * "1":"Sim",
     * "0":"Não",
     * }
     * })
     * Possiveis: visitante, usuario, suporte, admin
     */
    protected $ativado;

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
     * @return the $ativado
     */
    public function getAtivado()
    {
        return $this->ativado;
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
     * @param field_type $ativado            
     */
    public function setAtivado($ativado)
    {
        $this->ativado = $ativado;
    }
}

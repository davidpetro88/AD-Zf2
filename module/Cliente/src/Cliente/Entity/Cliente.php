<?php
namespace Cliente\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as Form;
use ZfcUser\Entity\UserInterface as ZfcUserInterface;
use ZfcRbac\Identity\IdentityInterface;
use LosBase\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="cliente")
 * @Form\Name("formCliente")
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Type("LosBase\Form\AbstractForm")
 */
class Cliente extends AbstractEntity
{

    /**
     * @ORM\Column(type="string", length=60)
     * @Form\Options({"label":"Nome"})
     * @Form\Type("text")
     */
    protected $nome;

    /**
     * @ORM\Column(type="string", length=256)
     * @Form\Options({"label":"E-mail"})
     * @Form\Type("text")
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=12)
     * @Form\Options({"label":"Celular"})
     * @Form\Type("text")
     */
    protected $celular;

    /**
     * @ORM\Column(type="string", length=12)
     * @Form\Options({"label":"Telefone"})
     * @Form\Type("text")
     */
    protected $telefone;

    /**
     * @ORM\Column(type="string", length=14)
     * @Form\Options({"label":"CPF"})
     * @Form\Type("text")
     */
    protected $cpf;

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
     * @return the $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @return the $celular
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     *
     * @return the $telefone
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     *
     * @return the $cpf
     */
    public function getCpf()
    {
        return $this->cpf;
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
     * @param field_type $email            
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     *
     * @param field_type $celular            
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    /**
     *
     * @param field_type $telefone            
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    /**
     *
     * @param field_type $cpf            
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }
}
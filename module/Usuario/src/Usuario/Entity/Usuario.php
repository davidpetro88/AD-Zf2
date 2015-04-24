<?php
namespace Usuario\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as Form;
use ZfcUser\Entity\UserInterface as ZfcUserInterface;
use ZfcRbac\Identity\IdentityInterface;
use LosBase\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 * @Form\Name("formUsuario")
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Type("LosBase\Form\AbstractForm")
 */
class Usuario extends AbstractEntity implements ZfcUserInterface, IdentityInterface
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
     * @ORM\Column(type="string", length=255)
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":255}})
     * @Form\Attributes({"type":"email"})
     * @Form\Options({"label":"Email"})
     */
    protected $email = '';

    /**
     * @ORM\ManyToOne(targetEntity="Cliente\Entity\Cliente", inversedBy="usuarios")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     * @ORM\OrderBy({"nome" = "ASC"})
     * @Form\Exclude()
     */
    protected $cliente;

    /**
     * @ORM\Column(type="string", length=32)
     * @Form\Type("Zend\Form\Element\Select")
     * @Form\Options({"label":"Permissão","value_options":{
     * "":"SELECIONE",
     * "admin":"Admin",
     * "gerente":"Gerente",
     * "suporte":"Suporte",
     * "usuario":"Usuário",
     * }
     * })
     * Possiveis: visitante, usuario, suporte, admin
     */
    protected $permissao = 'visitante';

    protected $username;

    /**
     * @ORM\Column(type="string", length=128)
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":6, "max":128}})
     * @Form\Attributes({"type":"password"})
     * @Form\Options({"label":"Senha"})
     */
    protected $password = '';

    /**
     * @ORM\Column(name="usr_password_salt", type="string", length=100, nullable=true)
     * @Form\Exclude()
     */
    protected $passwordsalt = '';

    /**
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":6, "max":32}})
     * @Form\Validator({"name":"Identical", "options":{"token":"password", "message":"As senhas não combinam"}})
     * @Form\Attributes({"type":"password"})
     * @Form\Options({"label":"Confirme a Senha"})
     */
    protected $confirmesenha;

    /**
     * @ORM\OneToMany(targetEntity="Usuario\Entity\Acesso", mappedBy="usuario")
     * @ORM\JoinColumn(nullable=false)
     * @Form\Exclude()
     */
    protected $acessos;

    /**
     *
     * @var string @ORM\Column(name="usr_registration_token", type="string", length=100, nullable=true)
     *      @Form\Exclude()
     */
    protected $usrRegistrationToken;

    /**
     *
     * @var boolean @ORM\Column(name="usr_active", type="boolean", nullable=false)
     *      @Form\Exclude()
     */
    protected $usrActive;

    /**
     *
     * @var boolean @ORM\Column(name="usr_email_confirmed", type="boolean", nullable=false)
     *      @Form\Exclude()
     */
    protected $usrEmailConfirmed;

    public function __construct()
    {
        $this->created = new \DateTime('now');
        $this->updated = new \DateTime('now');
        $this->acessos = new ArrayCollection();
    }

    /**
     *
     * @return string the $nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     *
     * @param string $nome            
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        
        return $this;
    }

    /**
     * Retorna o campo $permissao
     *
     * @return $permissao
     */
    public function getPermissao()
    {
        return $this->permissao;
    }

    /**
     * Seta o campo $permissao
     *
     * @param field_type $permissao            
     * @return $this
     */
    public function setPermissao($permissao)
    {
        $this->permissao = $permissao;
        
        return $this;
    }

    public function getRoles()
    {
        return array(
            $this->permissao
        );
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getDisplayName()
    {
        return $this->getNome();
    }

    public function setDisplayName($displayName)
    {}

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        if (! empty($password)) {
            $this->password = (string) $password;
        }
    }

    public function getState()
    {}

    public function setState($state)
    {}

    public function getConfirmesenha()
    {
        return $this->confirmesenha;
    }

    public function setConfirmesenha($confirmesenha)
    {
        $this->confirmesenha = $confirmesenha;
        return $this;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
        return $this;
    }

    public function getAcessos()
    {
        return $this->acessos;
    }

    public function setAcessos($acessos)
    {
        $this->acessos = $acessos;
        return $this;
    }

    /**
     * Set usrRegistrationToken
     *
     * @param string $usrRegistrationToken            
     * @return Users
     */
    public function setUsrRegistrationToken($usrRegistrationToken)
    {
        $this->usrRegistrationToken = $usrRegistrationToken;
        
        return $this;
    }

    /**
     * Get usrRegistrationToken
     *
     * @return string
     */
    public function getUsrRegistrationToken()
    {
        return $this->usrRegistrationToken;
    }

    public function addAcessos(Collection $acessos)
    {
        foreach ($acessos as $acesso) {
            $acesso->setUsuario($this);
            $this->acessos->add($acesso);
        }
    }

    public function removeAcessos(Collection $acessos)
    {
        foreach ($acessos as $acesso) {
            $this->acessos->removeElement($acesso);
        }
    }

    public function addAcesso($acesso)
    {
        foreach ($this->acessos as $tok) {
            if ($tok->getId() == $acesso->getId()) {
                return $this;
            }
        }
        $this->acessos[] = $acesso;
        return $this;
    }

    public function __toString()
    {
        return $this->getDisplayName();
    }

    public function getUsrActive()
    {
        return $this->usrActive;
    }

    public function setUsrActive($usrActive)
    {
        $this->usrActive = $usrActive;
        return $this;
    }

    public function getUsrEmailConfirmed()
    {
        return $this->usrEmailConfirmed;
    }

    public function setUsrEmailConfirmed($usrEmailConfirmed)
    {
        $this->usrEmailConfirmed = $usrEmailConfirmed;
        return $this;
    }

    public function getPasswordsalt()
    {
        return $this->passwordsalt;
    }

    public function setPasswordsalt($passwordsalt)
    {
        $this->passwordsalt = $passwordsalt;
        return $this;
    }
}

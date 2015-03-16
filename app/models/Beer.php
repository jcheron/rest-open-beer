<?php

/**
 * @author jc
 *
 */
class Beer extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var int
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $abv;

    /**
     * @var string
     */
    protected $photo;

    /**
     * @var DateTime
     */
    protected $created_at;

    /**
     * @var DateTime
     */
    protected $updated_at;

    /**
     * @var int
     */
    protected $idBrewery;


    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('beer');
    }

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	public function getAbv() {
		return $this->abv;
	}
	public function setAbv($abv) {
		$this->abv = $abv;
		return $this;
	}
	public function getCreatedAt() {
		return $this->created_at;
	}
	public function setCreatedAt($created_at) {
		$this->created_at = $created_at;
		return $this;
	}
	public function getUpdatedAt() {
		return $this->updated_at;
	}
	public function setUpdatedAt($updated_at) {
		$this->updated_at = $updated_at;
		return $this;
	}
	public function getIdBrewery() {
		return $this->idBrewery;
	}
	public function setIdBrewery($idBrewery) {
		$this->idBrewery = $idBrewery;
		return $this;
	}
	public function getPhoto() {
		return $this->photo;
	}
	public function setPhoto($photo) {
		$this->photo = $photo;
		return $this;
	}
}

<?php

class Brewery extends \Phalcon\Mvc\Model
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
    protected $url;

    /**
     * @var string
     */
    protected $photo;

    /**
     * @var string
     */
    protected $thumbnail;
    /**
     * @var DateTime
     */
    protected $created_at;

    /**
     * @var DateTime
     */
    protected $updated_at;


    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('brewery');
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
	public function getUrl() {
		return $this->url;
	}
	public function setUrl($url) {
		$this->url = $url;
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
	public function getPhoto() {
		return $this->photo;
	}
	public function setPhoto($photo) {
		$this->photo = $photo;
		return $this;
	}
	public function getThumbnail() {
		return $this->thumbnail;
	}
	public function setThumbnail($thumbnail) {
		$this->thumbnail = $thumbnail;
		return $this;
	}



}

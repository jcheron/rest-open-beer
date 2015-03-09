<?php

use Ovide\Libs\Mvc\Rest\Response;
use Ovide\Libs\Mvc\Rest\Exception\NotFound;
use Ovide\Libs\Mvc\Rest\Exception\Conflict;
use Ovide\Libs\Mvc\Rest\Exception\Unauthorized;
class Breweries extends MainRestController{
	const PATH='/breweries';

	public function get()
    {
    	$breweries=Brewery::find();
    	$breweries=$breweries->toArray();
    	if(sizeof($breweries)==0)
    		throw new NotFound("Aucun brasseur trouvé");
        return $breweries;
    }

    public function getOne($id){
		if (!$brewery = Brewery::findFirst($id))
			throw new NotFound("Ooops! Le brasseur {$id} est introuvable");
        return $brewery->toArray();
    }

    public function post($obj){
		if($this->_isValidToken($this->request->get("token"),$this->request->get("force"))){
			$brewery = new Brewery();
			$obj["created_at"]=(new DateTime())->format('Y-m-d H:i:s');
			$obj["updated_at"]=(new DateTime())->format('Y-m-d H:i:s');
			if($brewery->create($obj)==false){
				throw new Conflict("Impossible d'ajouter '".$obj["name"]."' dans la base de données.");
			}else{
				return array("data"=>$brewery->toArray(),"message"=>$this->successMessage("'".$brewery->getName()."' a été correctement ajoutée dans les brasseries."));
			}
		}else{
			throw new Unauthorized("Vous n'avez pas les droits pour ajouter une brasserie");
		}
    }

    public function put($id, $obj){
		if($this->_isValidToken($this->request->get("token"),$this->request->get("force"))){
			$brewery = Brewery::findFirst($id);
			if(!$brewery){
				throw new NotFound("Mise à jour : La brasserie '".$obj["name"]."' n'existe plus dans la base de données.");
				return array();
			}else{
				$brewery->setName($obj["name"]);
				$brewery->setUrl($obj["url"]);
				$brewery->setUpdatedAt((new DateTime())->format('Y-m-d H:i:s'));
				try{
					$brewery->save();
					return array("data"=>$obj,"message"=>$this->successMessage("'".$obj["name"]."' a été correctement modifiée."));
				}
				catch(Exception $e){
					throw new Conflict("Impossible de modifier '".$obj["name"]."' dans la base de données.<br>".$e->getMessage());
				}
			}
		}else{
			throw new Unauthorized("Vous n'avez pas les droits pour modifier une brasserie");
		}
    }

    public function delete($id){
    	if($this->_isValidToken($this->request->get("token"),$this->request->get("force"))){
			$brewery = Brewery::findFirst($id);
			if(!$brewery){
				return array("message"=>$this->warningMessage("Mise à jour : La brasserie d'id '".$id."' n'existe plus dans la base de données."),"code"=>Response::UNAVAILABLE);
			}else{
				try{
					$brewery->delete();
					return array("data"=>$brewery->toArray(),"message"=>$this->successMessage("'".$brewery->getName()."' a été correctement supprimée de l'ensemble des brasseries."));
				}
				catch(Exception $e){
					throw new Conflict("Impossible de supprimer '".$brewery->getName()."' dans la base de données.<br>".$e->getMessage());
				}
			}
		}else{
			throw new Unauthorized("Vous n'avez pas les droits pour supprimer une brasserie");
		}
    }
}
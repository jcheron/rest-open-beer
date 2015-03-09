<?php
use Ovide\Libs\Mvc\Rest\Response;
use Ovide\Libs\Mvc\Rest\Exception\NotFound;
use Ovide\Libs\Mvc\Rest\Exception\Conflict;
use Ovide\Libs\Mvc\Rest\Exception\Unauthorized;

class Beers extends MainRestController{
	const PATH='/beers';

	public function get(){
    	$beers=Beer::find();
    	$beers=$beers->toArray();
    	if(sizeof($beers)==0)
    		throw new NotFound("Aucune bière trouvée");
        return $beers;
    }

    public function getOne($id){
    	if (!$beer = Beer::findFirst($id))
    		throw new NotFound("Ooops! Bière {$id} non trouvée");
        return $beer->toArray();
    }

    public function getBrewery($id){
    	$beers=Beer::find("idBrewery=".$id);
    	$beers=$beers->toArray();
    	if(sizeof($beers)==0)
    		throw new NotFound("Aucune bière trouvée pour la brasserie.");
    	return $beers;
    }

    public function post($obj)
    {
        if($this->_isValidToken($this->request->get("token"),$this->request->get("force"))){
	        $beer = new Beer();
	        $obj["created_at"]=(new DateTime())->format('Y-m-d H:i:s');
	        $obj["updated_at"]=(new DateTime())->format('Y-m-d H:i:s');
	        if($beer->create($obj)==false){
	        	throw new Conflict("Impossible d'ajouter '".$obj["name"]."' dans la base de données.");
	        }else{
				return array("data"=>$beer->toArray(),"message"=>$this->successMessage("'".$beer->getName()."' a été correctement ajoutée dans les bières."));
	        }
        }else{
        	return array("message"=>"Vous n'avez pas les droits pour ajouter une bière");
        }
    }

    public function put($id, $obj)
    {
    if($this->_isValidToken($this->request->get("token"),$this->request->get("force"))){
        $beer = Beer::findFirst($id);
        if(!$beer){
        	throw new NotFound("Mise à jour : La bière '".$obj["name"]."' n'existe plus dans la base de données.");
        	return array();
        }else{
	        $beer->setName($obj["name"]);
	        $beer->setDescription($obj["description"]);
	        $beer->setAbv($obj["abv"]);
	        $beer->setIdBrewery($obj["idBrewery"]);
	        $beer->setUpdatedAt((new DateTime())->format('Y-m-d H:i:s'));
        		try{
					$beer->save();
					return array("data"=>$obj,"message"=>$this->successMessage("'".$obj["name"]."' a été correctement modifiée."));
				}
				catch(Exception $e){
					throw new Conflict("Impossible de modifier '".$obj["name"]."' dans la base de données.<br>".$e->getMessage());
				}
			}
	}else{
			throw new Unauthorized("Vous n'avez pas les droits pour modifier une bière");
		}
    }

    public function delete($id)
    {
        if($this->_isValidToken($this->request->get("token"),$this->request->get("force"))){
			$beer = Beer::findFirst($id);
			if(!$beer){
				return array("message"=>$this->warningMessage("Mise à jour : La bière d'id '".$id."' n'existe plus dans la base de données."),"code"=>Response::UNAVAILABLE);
			}else{
				try{
					$beer->delete();
					return array("data"=>$beer->toArray(),"message"=>$this->successMessage("'".$beer->getName()."' a été correctement supprimée de l'ensemble des bières."));
				}
				catch(Exception $e){
					throw new Conflict("Impossible de supprimer '".$beer->getName()."' dans la base de données.<br>".$e->getMessage());
				}
			}
		}else{
			throw new Unauthorized("Vous n'avez pas les droits pour supprimer une bière");
		}
    }
}
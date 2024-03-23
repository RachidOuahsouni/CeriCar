<?php

use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @Entity
 * @Table(name="jabaianb.trajet")
 */
class trajet{

	/** @Id
         *  @GeneratedValue
	 * @Column(type="integer")
	 */ 
	public $id;

	/** @Column(type="string", length=45) */ 
	public $depart;
		
	/** @Column(type="string", length=45) */ 
	public $arrivee;

    	/** @Column(type="integer") */  
   	 public $distance;
	
}

?>
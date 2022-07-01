<?php
/* This file is part of Jeedom.
*
* Jeedom is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* Jeedom is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
*/

/* * ***************************Includes********************************* */
require_once __DIR__  . '/../../../../core/php/core.inc.php';

class modbusFlex extends eqLogic {
  /*     * *************************Attributs****************************** */

  /*
  * Permet de définir les possibilités de personnalisation du widget (en cas d'utilisation de la fonction 'toHtml' par exemple)
  * Tableau multidimensionnel - exemple: array('custom' => true, 'custom::layout' => false)
  public static $_widgetPossibility = array();
  */

  /*
  * Permet de crypter/décrypter automatiquement des champs de configuration du plugin
  * Exemple : "param1" & "param2" seront cryptés mais pas "param3"
  public static $_encryptConfigKey = array();
  */

	/*     * ***********************Methode static*************************** */
	// Template came with all jeedom cron functions
	//Fonction exécutée automatiquement toutes les minutes par Jeedom
	public static function cron() {
		log::add('modbusFlex_cron', 'debug', 'Running cron()', );
	}

  /*     * *********************Méthodes d'instance************************* */

  // Fonction exécutée automatiquement avant la création de l'équipement
  public function preInsert() {
  }

  // Fonction exécutée automatiquement après la création de l'équipement
  public function postInsert() {
  }

	// Fonction exécutée automatiquement avant la mise à jour de l'équipement
	public function preUpdate() {
		if ($this->getConfiguration('ip') == '') {
			throw new Exception(__('L\'adresse IP ne peut pas être vide', __FILE__));
		}
	}

	// Fonction exécutée automatiquement après la mise à jour de l'équipement
	public function postUpdate() {
		//$cron = cron::byClassAndFunction('modbusFlex', 'updateModbusData', array('modbus_id' => intval($this->getId())));
		//if (!is_object($cron)) {
		//	$cron = new cron();
		//	$cron->setClass('modbusFlex');
		//	$cron->setFunction('updateModbusData');
		//	$cron->setOption(array('modbus_id' => intval($this->getId())));
		//}
		//$cron->setSchedule($this->getConfiguration('refreshCron', '* * * * *')); // TODO - Link cron to configuration
		//$cron->save();
	}

	// Fonction exécutée automatiquement avant la sauvegarde (création ou mise à jour) de l'équipement
	public function preSave() {
		if ($this->getConfiguration('autorefresh') == '') {
			$this->setConfiguration('autorefresh', '* * * * *');
		}
		if ($this->getConfiguration('port') == '') {
			$this->setConfiguration('port', '502');
		}
	}

  // Fonction exécutée automatiquement après la sauvegarde (création ou mise à jour) de l'équipement
  public function postSave() {
  }

  // Fonction exécutée automatiquement avant la suppression de l'équipement
  public function preRemove() {
  }

  // Fonction exécutée automatiquement après la suppression de l'équipement
  public function postRemove() {
  }

public static function updateModbusData($_options) {
	//$modbusFlex = modbusFlex::byId($_options['modbus_id']);
	//if (is_object($modbusFlex)) {
	//	foreach ($modbusFlex->getCmd('info') as $cmd) {
	//		$modbusFlex->checkAndUpdateCmd($cmd,$cmd->execute());
	//	}
	//}
}
  /*
  * Permet de crypter/décrypter automatiquement des champs de configuration des équipements
  * Exemple avec le champ "Mot de passe" (password)
  public function decrypt() {
    $this->setConfiguration('password', utils::decrypt($this->getConfiguration('password')));
  }
  public function encrypt() {
    $this->setConfiguration('password', utils::encrypt($this->getConfiguration('password')));
  }
  */

  /*
  * Permet de modifier l'affichage du widget (également utilisable par les commandes)
  public function toHtml($_version = 'dashboard') {}
  */

  /*
  * Permet de déclencher une action avant modification d'une variable de configuration du plugin
  * Exemple avec la variable "param3"
  public static function preConfig_param3( $value ) {
    // do some checks or modify on $value
    return $value;
  }
  */

  /*
  * Permet de déclencher une action après modification d'une variable de configuration du plugin
  * Exemple avec la variable "param3"
  public static function postConfig_param3($value) {
    // no return value
  }
  */

  /*     * **********************Getteur Setteur*************************** */

}

class modbusFlexCmd extends cmd {
  /*     * *************************Attributs****************************** */

  /*
  public static $_widgetPossibility = array();
  */

  /*     * ***********************Methode static*************************** */


  /*     * *********************Methode d'instance************************* */

	* Permet d'empêcher la suppression des commandes même si elles ne sont pas dans la nouvelle configuration de l'équipement envoyé en JS
  public function dontRemoveCmd() {
    return true;
  }

	// Exécution d'une commande
	public function execute($_options = array()) {
		// Sample function from Jeedom documentation (https://doc.jeedom.com/fr_FR/dev/plugin_template)
		if (!isset($_options['title']) && !isset($_options['message'])) {
			throw new Exception(__("Le titre ou le message ne peuvent être tous les deux vide", __FILE__));
		}
		$eqLogic = $this->getEqLogic();
		
		$message = '';
		if (isset($_options['title'])) {
			$message = $_options['title'] . '. ';
		}
		$message .= $_options['message'];
		//$http = new com_http($eqLogic->getConfiguration('addrSrvTts') . '/?tts=' . urlencode($message));
		//return $http->exec();
		
		//TODO - Call pymodbus
		return $message;
	}

  /*     * **********************Getteur Setteur*************************** */

}

<?php
namespace TDroidd\Spectator;

use pocketmine\event\player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\PluginCommand;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat;
use pocketmine\level\Level;
use pocketmine\server;

class Main extends PluginBase implements Listener {
       	 public function onEnable(){
                $this->saveDefaultConfig();
		$this->reloadConfig();
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->getLogger()->info("§eSpectator 1.0 By §bTDroidd §aEnabled!");
         }
        
         public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
             $cfg = $this->getConfig();
             $defgm = $cfg->get("Default-Game-Mode");
             $tptosp = $cfg->get("Teleport-To-Spawn");
             if(isset($args[0])){
                switch($args[0]){
                case "on":
	            	$sender->setGamemode(3);
	            	$sender->sendMessage(TextFormat::GREEN . "You are now a Spectator!");
	            	$this->getLogger()->info($sender->getName() . " Has changed his gamemode to Spectator");
	                return true;
                case "off":
	           	$sender->setGamemode($defgm);
	   		$sender->sendMessage(TextFormat::YELLOW . "You are no longer Espectator");
            		if($tptosp === true) $sender->teleport($this->getServer()->getDefaultLevel()->getSpawn());
                    return true;
                    }
                }
                return false;
	}
        public function onDisable() {
	$this->getLogger()->info("§eSpectator By §bTDroidd §av1.5 §4Unloaded!");
	}
}

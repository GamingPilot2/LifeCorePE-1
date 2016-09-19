<?php

namespace LifeCorePE;

use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandExecuter;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;

class Main extends PluginBase implements Listener{
    public function onEnable(){
      $this->getLogger()->info("LifeCorePE is now enabled.");
      $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function onCommand(CommandSender $sender, Command $command, $label, array $args){
      switch($command->getName()){

       case "heal":
         if($sender->hasPermission("lc.heal")){
           $player = $sender->getServer()->getPlayer($args[0]);
           $sender->sendMessage("La vie du joueur ".$args[0]." a été restaurée...");
           $player->setHealth(20);
           $player->sendMessage("Ta vie a été restaurée.");
         }else{
           $sender->sendMessage("You don't have permission to do this.");
         }
         return true;

       case "feed":
         if($sender->hasPermission("lc.feed")){
           $player = $sender->getServer()->getPlayer($args[0]);
           $sender->sendMessage("La barre de faim du joueur ".$args[0]." a été restaurée...");
           $player->setFood(20);
           $player->sendMessage("Ta barre de faim a été restaurée.");
         }else{
           $sender->sendMessage("You don't have permission to do this.");
         }
         return true;

       case "clear":
         if($sender->hasPermission("lc.clear")){
           $player = $sender->getServer()->getPlayer($args[0]);
           $sender->sendMessage("L'inventaire du joueur ".$args[0]." a été réinitialisé...");
           $player->setFood(20);
           $player->sendMessage("Ton inventaire a été réinitialisé.");
         }else{
           $sender->sendMessage("You don't have permission to do this.");
         }
         return true;

       case "spawn":
         if($sender->hasPermission("lc.spawn")){
           $spawn = $this->getServer()->getDefaultLevel()->getSafeSpawn();
           $this->getServer()->loadLevel($spawn);
           $sender->teleport($spawn);
         }else{
           $sender->sendMessage("You don't have permission to do this.");
         }
         return true;
       }
    }
}
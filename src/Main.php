<?php

namespace Revive;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class Main extends PluginBase implements Listener{
    
    public function onEnable() {
        $this->getLogger()->info("[Heal] Plugin enabled");
    }
    public function onDisable() {
        $this->getLogger()->info("[Heal] Plugin disabled");
    }
    
    public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
        if(strtolower($command->getName()) === 'revive'){ // 3 = for strings better practice
        if(isset($args[0])){ //better way to check 
            $player = $this->getServer()->getPlayer($args[0]);
            if($player instanceof Player){ //checks if its a actual player
                $player = $this->getServer()->getPlayer($player);
                $player->setHealth(10);
                $sender->sendMessage(COLOR::BLUE."Player ".$player->getName()."has been revived!");
                $player->sendMessage(COLOR::GREEN."You have been revived!");
                $player->sendPopup("You have been reived");
                return;
            } else {
                $sender->sendMessage(Color::RED."Invalid player");
                return;   
            }
        } else {
            if ($sender instanceof Player){ //checks if sender is a player
                $sender->setHealth(10);
                $sender->sendMessage(Color::GREEN."You have been revived");
                return;
            }
            $sender->sendPopup("Run this command in-game please");
        }
      }
    }
}

<?php

declare(strict_types=1);

namespace cawloft\CustomErrorMessage;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\protocol\DisconnectPacket;
use pocketmine\plugin\PluginBase;

class CustomErrorMessage extends PluginBase implements Listener{

    public function onDataPacketSend(DataPacketSendEvent $ev){
        $pk = $ev->getPacket();
        if($pk instanceof DisconnectPacket){
            if($pk->message === "Internal server error"){
                $pk->message = $this->getConfig()->get("error-message", "You've caught a bug!\nPlease contact the server administrator.");
            }
        }
    }

    public function onEnable(){
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

}
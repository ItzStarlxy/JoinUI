<?php

namespace ItzStarlxy\JoinUI;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerJoinEvent;
use libs\Vecnavium\FormsUI\SimpleForm;
use libs\Vecnavium\FormsUI\FormsUI;
use function str_replace;

class Main extends PluginBase implements Listener {
	
	public function onEnable(): void {
		$this->getLogger()->info("Plugin has Enabled");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveResource("config.yml");
		$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
	}
	
	public function onDisable(): void {
		$this->getLogger()->info("Plugin has Disable");
	}
	
	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayerByPrefix();
		$this->onForm($player);
	}
	
	public function onForm(Player $player){
		$form = new SimpleForm(function(Player $player, $data = null){
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
				break;
			}
		});
		$form->setTitle(str_replace(["{player}"], [$player->getPlayerByPrefix()], $this->config->get("form-title")));
		$form->setContent(str_replace(["{player}"], [$player->getPlayerByPrefix()], $this->config->get("form-content")));
		$form->addButton($this->config->get("close-button"));
		$form->sendToPlayer($player);
	}
}

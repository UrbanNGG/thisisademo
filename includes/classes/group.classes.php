<?php
$VehicleName = array(
	"Landstalker","Bravura","Buffalo","Linerunner","Perrenial","Sentinel",
	"Dumper","Firetruck","Trashmaster","Stretch","Manana","Infernus",
	"Voodoo","Pony","Mule","Cheetah","Ambulance","Leviathan","Moonbeam",
	"Esperanto","Taxi","Washington","Bobcat","Whoopee","BF Injection",
	"Hunter","Premier","Enforcer","Securicar","Banshee","Predator","Bus",
	"Rhino","Barracks","Hotknife","Trailer","Previon","Coach","Cabbie",
	"Stallion","Rumpo","RC Bandit","Romero","Packer","Monster","Admiral",
	"Squalo","Seasparrow","Pizzaboy","Tram","Trailer","Turismo","Speeder",
	"Reefer","Tropic","Flatbed","Yankee","Caddy","Solair","Berkley's RC Van",
	"Skimmer","PCJ-600","Faggio","Freeway","RC Baron","RC Raider","Glendale",
	"Oceanic","Sanchez","Sparrow","Patriot","Quad","Coastguard","Dinghy",
	"Hermes","Sabre","Rustler","ZR-350","Walton","Regina","Comet","BMX",
	"Burrito","Camper","Marquis","Baggage","Dozer","Maverick","News Chopper",
	"Rancher","FBI Rancher","Virgo","Greenwood","Jetmax","Hotring","Sandking",
	"Blista Compact","Police Maverick","Boxvillde","Benson","Mesa","RC Goblin",
	"Hotring Racer A","Hotring Racer B","Bloodring Banger","Rancher","Super GT",
	"Elegant","Journey","Bike","Mountain Bike","Beagle","Cropduster","Stunt",
	"Tanker","Roadtrain","Nebula","Majestic","Buccaneer","Shamal","Hydra",
	"FCR-900","NRG-500","HPV1000","Cement Truck","Tow Truck","Fortune",
	"Cadrona","FBI Truck","Willard","Forklift","Tractor","Combine","Feltzer",
	"Remington","Slamvan","Blade","Freight","Streak","Vortex","Vincent",
	"Bullet","Clover","Sadler","Firetruck","Hustler","Intruder","Primo",
	"Cargobob","Tampa","Sunrise","Merit","Utility","Nevada","Yosemite",
	"Windsor","Monster","Monster","Uranus","Jester","Sultan","Stratum",
	"Elegy","Blackhawk","RC Tiger","Flash","Tahoma","Savanna","Bandito",
	"Freight Flat","Streak Carriage","Kart","Mower","Dune","Sweeper",
	"Broadway","Tornado","AT-400","DFT-30","Huntley","Stafford","BF-400",
	"News Van","Tug","Trailer","Emperor","Wayfarer","Euros","Hotdog","Club",
	"Freight Box","Trailer","Andromada","Dodo","RC Cam","Launch","Police Car",
	"Police Car","Police Car","Police Ranger","Picador","S.W.A.T","Alpha",
	"Phoenix","Glendale","Sadler","Luggage","Luggage","Stairs","Boxville",
	"Tiller","Utility Trailer"
);
function returnVehicleName($id)
{
	return $GLOBALS['VehicleName'][$id-400];
}
function displayGroupVehicles($group_id)
{
	$db = $GLOBALS['odb'];
	$stmt = $db->prepare("SELECT * FROM `groupvehs` WHERE `gID`=?");
	$stmt->execute(array($group_id));
	?>
	<table class='table table-striped datatable'>
		<thead>
			<tr>
				<td>Spawned ID</td>
				<td>Vehicle Type</td>
				<td>Vehicle License #</td>
				<td>Vehicle Max Health</td>
				<td>Vehicle Fuel</td>
				<td>Upkeep Cost ($)</td>

			</tr>
		</thead>
		<tbody>
			<?php
			while($gveh = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
				<td><?php echo $gveh['SpawnedID'] == "65535" ? 'Despawned' : $gveh['SpawnedID']; ?></td>
				<td><?php echo returnVehicleName($gveh['vModel']); ?></td>
				<td><?php echo $gveh['vPlate']; ?></td>
				<td><?php echo $gveh['vMaxHealth']; ?></td>
				<td><?php echo $gveh['vFuel']; ?></td>
				<td><?php echo $gveh['vUpkeep'] != 0 ? '$'.number_format($gveh['vUpkeep']) : "Free"; ?></td>
				<?php
			}
			?>
		</tbody>
	</table>
	<?php


}

class Group
{
	public $_id;
	protected $_db;
	protected $_info;
	protected $_ranks;
	protected $_divisions;

	public function __construct(PDO $db, $id)
	{
		$this->_id = $id;
		$this->_db = $db;

		$this->generateInfo();
		$this->generateRanks();
		$this->generateDivisions();
	}
	protected function generateInfo()
	{
		$stmt = $this->_db->prepare("SELECT `Type`, `Name` FROM `groups` WHERE `id`=:id");
		$stmt->execute(array(':id' => $this->_id));
		$this->_info = $stmt->fetch(PDO::FETCH_ASSOC);
	}
	protected function generateRanks()
	{
		$query = "SELECT ";
		for ($i=0; $i < 10; $i++) {
			if($i < 9) {
				$query .= '`Rank'.$i.'`,';
			}
			if($i == 9)
			{
				$query .= '`Rank'.$i.'`';
			}
		}
		$query .= " FROM `groups` WHERE `id`=:id";
		$stmt = $this->_db->prepare($query);
		$stmt->execute(array(':id' => $this->_id));
		$this->_ranks = $stmt->fetch(PDO::FETCH_ASSOC);
		if($stmt->rowCount() == 0)
		{
			$this->_ranks == "N/A";
		}

	}
	protected function generateDivisions()
	{
		$query = "SELECT ";
		for ($i=0; $i < 11; $i++) {
			if($i < 10) {
				$query .= '`Div'.$i.'`,';
			}
			if($i == 10)
			{
				$query .= '`Div'.$i.'`';
			}
		}
		$query .= " FROM `groups` WHERE `id`=:id";
		$stmt = $this->_db->prepare($query);
		$stmt->execute(array(':id' => $this->_id));
		$this->_divisions = $stmt->fetch(PDO::FETCH_ASSOC);
		if($stmt->rowCount() == 0)
		{
			$this->_divisions == "N/A";
		}

	}
	public function Info()
	{
		return $this->_info;
	}
	public function Ranks()
	{
		return $this->_ranks;
	}
	public function Divisions()
	{
		return $this->_divisions;
	}

}

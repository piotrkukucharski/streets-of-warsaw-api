<?php


namespace app\commands;


use app\models\District;
use app\models\MigrationCsv;
use app\models\Street;
use app\models\Type;
use League\Csv\Reader;
use yii\console\Controller;
use yii\db\Query;

class StreetImporterController extends Controller
{
	const URL_CSV = 'https://raw.githubusercontent.com/PISK12/streets-of-Warsaw/master/streets-of-warsaw.csv';

	/**
	 * @var Reader
	 */
	private $csv;

	public function actionIndex()
	{
		$str_csv = file_get_contents(self::URL_CSV);
		$md5_csv = md5($str_csv);

		if (MigrationCsv::findOne(['hash' => $md5_csv]) !== Null) {
			if (count(Street::findAll([])) > 0 && count(Type::findAll([])) > 0 && count(District::findAll([])) > 0) {
				MigrationCsv::deleteAll();
			} else {
				echo 'CSV was migrate' . PHP_EOL;
				die;
			}

		}

		$this->csv = Reader::createFromString($str_csv);
		$this->csv->setHeaderOffset(0);
		echo 'import districts' . PHP_EOL;
		$this->importDistricts();
		echo 'import types' . PHP_EOL;
		$this->importTypes();
		echo 'import streets' . PHP_EOL;
		Street::deleteAll();
		foreach ($this->csv->getRecords() as $record) {
			if (Street::findOne(['name' => trim($record['Full Name'])]) === Null) {
				$street = new Street();
				$street->name = trim($record['Full Name']);
				$street->filler_name = trim($record['Filler Name']);
				$street->short_name = trim($record['Short Name']);
				$street->id_type = Type::findOne(['name' => trim($record['Type'])])->id;
				$street->save();
				foreach (explode(',', $record['Districts']) as $district_name) {
					$street->link('districts', District::findOne(['name' => trim($district_name)]));
				}
			}
		}
		$migrationCsv = new MigrationCsv();
		$migrationCsv->hash = $md5_csv;
		$migrationCsv->created_at = (new \DateTime())->format('Y-m-d H:i:s');
		$migrationCsv->save();
	}

	private function importDistricts()
	{
		District::deleteAll();
		foreach ($this->csv->getRecords() as $record) {
			$districts = explode(',', $record['Districts']);
			foreach ($districts as $item) {
				if (District::findOne(['name' => trim($item)]) === Null) {
					$district = new District();
					$district->name = trim($item);
					$district->save();
					unset($district);
				}
			}
		}
	}

	private function importTypes()
	{
		Type::deleteAll();
		foreach ($this->csv->getRecords() as $record) {
			$type_name = trim($record['Type']);
			if (Type::findOne(['name' => $type_name]) === Null) {
				$type = new Type();
				$type->name = $type_name;
				$type->save();
				unset($type);
			}
		}
	}

}

<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Settings as SettingsModel;

/**
 * Settings represents the model behind the search form about `app\models\Settings`.
 */
class Settings extends SettingsModel {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['setting_id'], 'integer'],
            [['key', 'value'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = SettingsModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'setting_id' => $this->setting_id,
        ]);

        $query->andFilterWhere(['like', 'key', $this->key])
                ->andFilterWhere(['like', 'value', $this->value]);
        \yii\i18n\Formatter::className();
        return $dataProvider;
    }

    public function getCrudColumns() {
        return [
            'key',
            'value:html'
        ];
    }

}

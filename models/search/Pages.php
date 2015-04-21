<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pages as PagesModel;

/**
 * Pages represents the model behind the search form about `app\models\Pages`.
 */
class Pages extends PagesModel {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['page_id'], 'integer'],
            [['token', 'text', 'title'], 'safe'],
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
        $query = PagesModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'page_id' => $this->page_id,
        ]);

        $query->andFilterWhere(['like', 'token', $this->token])
                ->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }

    public function getCrudColumns() {
        return [
            'token',
            'title'
        ];
    }

}

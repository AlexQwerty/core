<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Images as ImagesModel;

/**
 * Products represents the model behind the search form about `app\models\Products`.
 */
class Images extends ImagesModel {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['image_id', 'user_id', 'url', 'thumb'], 'integer'],
            [['describe', 'key'], 'safe'],
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
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'image_id' => $this->image_id,
            'user_id' => $this->user_id
        ]);

        $query->andFilterWhere(['like', 'describe', $this->describe])
                ->andFilterWhere(['like', 'url', $this->url])
                ->andFilterWhere(['like', 'thumb', $this->thumb]);
        
        $query->orderBy('image_id desc');
        return $dataProvider;
    }

}

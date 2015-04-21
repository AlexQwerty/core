<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UsersSearch represents the model behind the search form about `app\models\Users`.
 */
class Users extends \app\models\Users {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'role_id'], 'integer'],
            [['password', 'email', 'access_token'], 'safe'],
        ];
    }

    public function getCrudColumns() {
        return[
            'email',
            'role_id'
//            [
//                'attribute' => 'role_id',
//                'value' => 'role.name',
//                'filter' => ArrayHelper::map(Role::find()->all(), 'id', 'name')
//            ],
//            'created_at:datetime',
//            'updated_at:datetime',
//            [
//                'attribute' => 'status_id',
//                'value' => 'status.name',
//                'filter' => ArrayHelper::map(Status::find()->all(), 'id', 'name')
//            ],
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
        $query = Users::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'role_id' => $this->role_id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'access_token', $this->access_token]);

        return $dataProvider;
    }

}

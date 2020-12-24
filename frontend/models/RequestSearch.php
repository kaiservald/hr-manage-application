<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Request;

/**
 * RequestSearch represents the model behind the search form of `frontend\models\Request`.
 */
class RequestSearch extends Request
{
    public $username;
    public $vacancy;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'vacancy_id', 'created_by', 'status'], 'integer'],
            [['first_name', 'last_name'], 'string'],

            [['created_at', 'resume', 'username', 'vacancy'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Request::find();
        $query->leftJoin('user', 'user.id=request.created_by');
        $query->leftJoin('vacancy', 'vacancy.vacancy_id=request.vacancy_id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['username'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC]
        ];

        $dataProvider->sort->attributes['task'] = [
            'asc' => ['vacancy.title' => SORT_ASC],
            'desc' => ['vacancy.title' => SORT_DESC]
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'request_id' => $this->request_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'vacancy_id' => $this->vacancy_id,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'resume', $this->resume])
            ->andFilterWhere(['like', 'user.username', $this->username])
            ->andFilterWhere(['like', 'vacancy.title', $this->vacancy]);;

        return $dataProvider;
    }
}

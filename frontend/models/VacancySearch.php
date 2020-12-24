<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Vacancy;

/**
 * VacancySearch represents the model behind the search form of `frontend\models\Vacancy`.
 */
class VacancySearch extends Vacancy
{

    public $username;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vacancy_id', 'status', 'created_by'], 'integer'],
            [['title', 'description', 'created_at', 'username'], 'safe'],
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
        $query = Vacancy::find();
        $query->leftJoin('user', 'user.id=vacancy.created_by');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['username'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC]
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'vacancy_id' => $this->vacancy_id,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'user.username', $this->username]);

        return $dataProvider;
    }
}

<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Task;

/**
 * TaskSearch represents the model behind the search form of `frontend\models\Task`.
 */
class TaskSearch extends Task
{
    public $username;
    public $category;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'user_id'], 'integer'],
            [['title', 'description', 'function_name', 'function_description', 'username', 'category', 'created_at'], 'safe'],
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
        $query = Task::find();
        $query->joinWith(['user']);
        $query->leftJoin('category', 'category.category_id=task.category_id');


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['username'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC]
        ];

        $dataProvider->sort->attributes['category'] = [
            'asc' => ['category.name' => SORT_ASC],
            'desc' => ['category.name' => SORT_DESC]
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'task_id' => $this->task_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'function_name', $this->function_name])
            ->andFilterWhere(['like', 'function_description', $this->function_description])
            ->andFilterWhere(['like', 'user.username', $this->username])
            ->andFilterWhere(['like', 'category.name', $this->category]);

        return $dataProvider;
    }
}

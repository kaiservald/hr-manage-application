<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Solution;

/**
 * SolutionSearch represents the model behind the search form of `frontend\models\Solution`.
 */
class SolutionSearch extends Solution
{
    public $username;
    public $task;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['solution_id', 'task_id', 'user_id', 'test_result'], 'integer'],
            [['solution', 'username', 'task', 'created_at'], 'safe'],
            [['result'], 'number'],
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
        $query = Solution::find();
        $query->joinWith(['user']);
        $query->leftJoin('task', 'task.task_id=solution.task_id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['username'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC]
        ];

        $dataProvider->sort->attributes['task'] = [
            'asc' => ['task.title' => SORT_ASC],
            'desc' => ['task.title' => SORT_DESC]
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'solution_id' => $this->solution_id,
            'task_id' => $this->task_id,
            'solution.user_id' => $this->user_id,
            'test_result' => $this->test_result,
            'result' => $this->result,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'solution', $this->solution])
        ->andFilterWhere(['like', 'user.username', $this->username])
        ->andFilterWhere(['like', 'task.title', $this->task]);

        return $dataProvider;
    }
}

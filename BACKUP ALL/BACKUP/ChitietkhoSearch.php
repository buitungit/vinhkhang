<?php

namespace backend\models\search;

use backend\models\Chitietkho;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * KhoSearch represents the model behind the search form about `backend\models\Kho`.
 */
class ChitietkhoSearch extends Chitietkho
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tenhang', 'codehang', 'tendvt', 'codedvt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Chitietkho::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['tenhang' => SORT_ASC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->tenhang])
            ->andFilterWhere(['like', 'code', $this->codehang])
            ->andFilterWhere(['like', 'code', $this->tendvt])
            ->andFilterWhere(['like', 'code', $this->codedvt]);

        return $dataProvider;
    }
}

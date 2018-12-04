<?php

namespace common\models\tables;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Task[] $tasks
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getTasks()
    {
        return $this->hasMany(Task::class, ['project_id' => 'id']);
    }

    public
    static function findCurrentTask()
    {
        return self::find()
//            ->with('tasks')
//            ->leftJoin('task', 'project.id = task.project_id')
            ->joinWith('tasks', true)
            ->where(['<', 'task.date_start', date('Y-m-d H:i:s')])
            ->andWhere(['<', 'task.date_end', date('Y-m-d H:i:s', strtotime('+1 month'))])
            ->andFilterWhere(['or', ['=', 'task.responsible_id', Yii::$app->user->id],
                ['=', 'task.initiator_id', Yii::$app->user->id]])
            ->orderBy(['project.id' => 'asc', 'task.date_start' => 'asc']);
    }
}

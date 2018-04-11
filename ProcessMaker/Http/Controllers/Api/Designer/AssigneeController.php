<?php

namespace ProcessMaker\Http\Controllers\Api\Designer;

use Illuminate\Http\Request;
use ProcessMaker\Facades\TaskManager;
use ProcessMaker\Http\Controllers\Controller;
use ProcessMaker\Model\Activity;
use ProcessMaker\Model\Process;
use ProcessMaker\Model\Task;

class AssigneeController extends Controller
{
    /**
     * List users and groups assigned to Task
     *
     * @param Process $process
     * @param Activity $activity
     * @param Request $request
     *
     * @return array
     */
    public function getActivityAssignees(Process $process, Activity $activity, Request $request)
    {
        $options = [
            'filter' => $request->input('filter', ''),
            'start' => $request->input('start', 0),
            'limit' => $request->input('limit', 20),
        ];
        return TaskManager::loadAssignees(new Task(['TAS_UID' => $activity->ACT_UID]), $options);
    }

    public function getActivityAssigneesPaged(Process $process, Activity $activity, Request $request)
    {

    }

    /**
     * Assign a user or group to a task.
     *
     * @param Process $process
     * @param Task $task
     * @param Request $request
     *
     * @return array
     */
    public function store(Process $process, Task $task, Request$request)
    {
        $options = [
            'aas_uid' => $request->input('aas_uid', ''),
            'aas_type' => $request->input('aas_type', ''),
        ];

        return TaskManager::saveAssignee($process, $task, $options);

    }

}
define(
    [
        'uiComponent',
        'jquery',
        'Magento_Ui/js/modal/confirm',
        'MageMastery_Todo/js/service/task'
    ],
    function (
        Component,
        $,
        modal,
        taskService
    ) {
        'use strict';

        return Component.extend({
            defaults: {
                newTaskLabel: '',
                buttonSelector: '#add-new-task-button',
                tasks: []
            },

            initObservable: function () {
                this._super().observe(['tasks', 'newTaskLabel']);

                taskService.getList().then((tasks) => {
                    this.tasks(tasks);
                    return tasks;
                });

                return this;
            },

            switchStatus: function (data, event) {
                const taskId = $(event.target).data('id');

                let items = this.tasks().map((task) => {
                    if (task.task_id === taskId) {
                        task.status = task.status === 'open' ? 'complete' : 'open';
                        taskService.changeStatus(taskId, task.status);
                    }

                    return task;
                });

                this.tasks(items);
            },
            
            deleteTask: function (taskId) {
                modal({
                   content: 'Are you sure you want to delete the task?',
                   actions: {
                       confirm: () => {
                           let tasks = [];

                           taskService.delete(this.tasks().find(task => {
                               if (task.task_id === taskId) {
                                   return task;
                               }
                           })).then(() => {
                               if (this.tasks().length === 1) {
                                   this.tasks(tasks);
                                   return;
                               }

                               this.tasks().forEach(function (task) {
                                   if (task.task_id !== taskId) {
                                       tasks.push(task);
                                   }
                               })

                               this.tasks(tasks);
                           })
                       }
                   }
                });
            },

            addTask: function () {
                this.tasks.push({
                   id: Math.floor(Math.random() * 100),
                   label: this.newTaskLabel(),
                   status: false
                });
                this.newTaskLabel('');
            },

            checkKey: function (data, event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    $(this.buttonSelector).click();
                }
            }
        });
    }
);

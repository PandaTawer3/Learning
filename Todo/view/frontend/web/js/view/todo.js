define(
    [
        'uiComponent',
        'jquery',
        'Magento_Ui/js/modal/confirm',
        'MageMastery_Todo/js/service/task',
        'MageMastery_Todo/js/model/loader'
    ],
    function (
        Component,
        $,
        modal,
        taskService,
        loader
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
                let task = {
                    label: this.newTaskLabel(),
                    status: 'open'
                };

                loader.startLoader();
                taskService.create(task).then(taskId => {
                    task.task_id = taskId;
                    this.tasks.push(task);
                    this.newTaskLabel('');
                }).finally(() => {
                    loader.stopLoader();
                })
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

define(['mage/storage'], function (storage) {
    'use strict';

    return {
        getList: async function () {
                return await storage.get('rest/V1/customer/todo/tasks');
        },

        changeStatus: async function (taskId, status) {
            return await storage.post(
              'rest/V1/customer/todo/task/update',
              JSON.stringify({
                  taskId: taskId,
                  status: status
              })
            );
        },

        delete: async function (task) {
            return await storage.post(
              'rest/V1/customer/todo/task/delete',
              JSON.stringify({
                  task: task
              })
            );
        }
    }
})
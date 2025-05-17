<!-- Tasks -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
    <div class="p-5 border-b border-gray-200 dark:border-gray-700">
        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Pending Tasks</h4>
    </div>
    <div class="p-5">
        <div class="mb-4">
            <div class="flex items-center mb-2">
                <input id="task-1" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="task-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Review monthly expense reports</label>
                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 ms-auto">Due today</span>
            </div>
            <div class="ms-6 text-xs text-gray-500 dark:text-gray-400">
                Finance department needs approval for Q3 expenses
            </div>
        </div>
        <div class="mb-4">
            <div class="flex items-center mb-2">
                <input id="task-2" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="task-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Schedule cement delivery for Plant B</label>
                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 ms-auto">Urgent</span>
            </div>
            <div class="ms-6 text-xs text-gray-500 dark:text-gray-400">
                Coordinate with supplier for next week delivery
            </div>
        </div>
        <div class="mb-4">
            <div class="flex items-center mb-2">
                <input id="task-3" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="task-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Approve new mix design for project XYZ</label>
                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ms-auto">In progress</span>
            </div>
            <div class="ms-6 text-xs text-gray-500 dark:text-gray-400">
                Quality team has submitted new mix design for high-strength concrete
            </div>
        </div>
        <div>
            <div class="flex items-center mb-2">
                <input id="task-4" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="task-4" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Interview candidates for batch plant operator</label>
                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 ms-auto">Scheduled</span>
            </div>
            <div class="ms-6 text-xs text-gray-500 dark:text-gray-400">
                HR has scheduled interviews for tomorrow at 10:00 AM
            </div>
        </div>
    </div>
    <div class="px-5 py-3 border-t border-gray-200 dark:border-gray-700 flex items-center">
        <form class="flex items-center flex-1">
            <input type="text" id="new-task" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Add new task...">
        </form>
        <button type="button" class="ms-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add</button>
    </div>
</div>
require('./bootstrap')

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import { variantJS, VariantJSConfiguration } from '@variantjs/vue'
import Toast from 'vue-toastification'

import icon from "@/Layouts/faicon.js"
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

const appName =
    window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'


const configuration = {
    TRichSelect: {
        classes: {
            wrapper: '',
            buttonWrapper: '',
            selectButton: 'text-black transition duration-100 ease-in-out bg-base-100 border border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed',
            selectButtonLabel: '',
            selectButtonTagWrapper: '-mx-2 -my-2.5 py-1 pr-8',
            selectButtonTag: 'bg-blue-500 block disabled:cursor-not-allowed disabled:opacity-50 duration-100 ease-in-out focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 rounded shadow-sm text-sm text-white transition white-space-no m-0.5 max-w-full overflow-hidden h-8 flex items-center',
            selectButtonTagText: 'px-3',
            selectButtonTagDeleteButton: '-ml-1.5 h-full hover:bg-blue-600 hover:shadow-sm inline-flex items-center px-2 transition',
            selectButtonTagDeleteButtonIcon: '',
            selectButtonPlaceholder: 'text-gray-400',
            selectButtonIcon: 'text-gray-600',
            selectButtonClearButton: 'hover:bg-blue-100 text-gray-600 rounded transition duration-100 ease-in-out',
            selectButtonClearIcon: '',
            dropdown: '-mt-1 bg-base-100 border-b border-base-300 border-l border-r rounded-b shadow-sm',
            dropdownFeedback: 'pb-2 px-3 text-gray-400 text-sm',
            loadingMoreResults: 'pb-2 px-3 text-gray-400 text-sm',
            optionsList: '',
            searchWrapper: 'p-2 placeholder-gray-400',
            searchBox: 'bg-base-100 text-sm rounded border focus:outline-none focus:shadow-outline border-base-300',
            optgroup: 'text-gray-400 uppercase text-xs py-1 px-2 font-semibold',
            option: '',
            disabledOption: '',
            highlightedOption: 'bg-base-300',
            selectedOption: 'font-semibold bg-primary font-semibold text-white',
            selectedHighlightedOption: 'font-semibold bg-primary font-semibold text-white',
            optionContent: 'flex justify-between items-center',
            optionLabel: 'text-base-content',
            selectedIcon: '',
            enterClass: 'opacity-0',
            enterActiveClass: 'transition ease-out duration-100',
            enterToClass: 'opacity-100',
            leaveClass: 'opacity-100',
            leaveActiveClass: 'transition ease-in duration-75',
            leaveToClass: 'opacity-0',
        }
    }
}

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .component('faicon', FontAwesomeIcon)
            .use(Toast, {
                hideProgressBar: true,
                closeOnClick: false,
                closeButton: false,
                icon: false,
                timeout: 5000,
                transition: 'Vue-Toastification__fade',
            })
            .use(variantJS, configuration)
            .mixin({ methods: { route } })
            .mount(el)
    },
})

InertiaProgress.init({ color: '#A855F7' })

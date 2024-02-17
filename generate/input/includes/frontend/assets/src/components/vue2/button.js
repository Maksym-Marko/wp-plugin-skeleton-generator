export const button = {
    props: {
        open: {
            type: Boolean,
            required: true
        }
    },
    template: `
        <div>
            <button
                type="button"
                @click="$emit('toggle')"
            >{{open ? 'Close' : 'Open'}}</button>
        </div>
    `
};
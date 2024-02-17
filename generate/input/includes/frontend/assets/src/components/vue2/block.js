export const block = {
    props: {
        open: {
            type: Boolean,
            required: true
        }
    },
    template: `
        <div>
            I am {{open ? 'opened' : 'closed'}}
        </div>
    `
};
import API from '@/services/API'
import store from '@/store'

const Pages = {
    getPages() {

        return new Promise( ( resolve, reject ) => {

            API.get( '/pages' )
                .then( res => {

                    if( res?.status === 200 ) {

                        console.log(res.data);

                        store.commit( {
                            type: 'pages/SET_PAGES',
                            pages: res.data,
                        } )

                        resolve()

                    }

                } )

        } )

    }
}

export default Pages
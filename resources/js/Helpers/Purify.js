import xss from 'xss';

export default function Purify(dirty)
{
    let options = {
        whiteList: {
            a: ['href', 'target'],
            span: ['class'],
            h1:[],
            h2:[],
            h3:[],
            code:[],
            pre:[],
            img:['src','alt'],
            b:[],
            p:[],
            strong:[],
            em:[],
            ul: [],
            ol: [],
            li: [],
            del: [],
            sub: [],
            sup: [],
            blockquote: [],
        },

    }; // Custom rules
    return xss(dirty, options);
}

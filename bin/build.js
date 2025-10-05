import * as esbuild from 'esbuild'

const isDev = process.argv.includes('--dev')

async function compile(options) {
    const ctx = await esbuild.context(options)
    if (isDev) {
        await ctx.watch()
    } else {
        await ctx.rebuild()
        await ctx.dispose()
    }
}

const defaultOptions = {
    define: { 'process.env.NODE_ENV': isDev ? `'development'` : `'production'` },
    bundle: true,
    mainFields: ['module', 'main'],
    platform: 'neutral',
    sourcemap: isDev ? 'inline' : false,
    sourcesContent: isDev,
    treeShaking: true,
    target: ['es2020'],
    minify: !isDev,
    plugins: [{
        name: 'watchPlugin',
        setup(build) {
            build.onStart(() => {
                console.log(`Build started: ${build.initialOptions.outfile}`)
            })
            build.onEnd((result) => {
                if (result.errors.length) {
                    console.log(`Build failed: ${build.initialOptions.outfile}`, result.errors)
                } else {
                    console.log(`Build finished: ${build.initialOptions.outfile}`)
                }
            })
        }
    }],
}

await compile({
    ...defaultOptions,
    entryPoints: ['./resources/js/components/panda-player.js'],
    outfile: './resources/js/dist/components/panda-player.js',
})

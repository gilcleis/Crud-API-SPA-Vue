<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">
                    CrudAPI
                </a>    
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <router-link active-class="active-menu"
                                         exact :to="{ name: 'posts.index' }"
                                         class="nav-link">Lista Mensagens</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link active-class="active-menu"
                                         exact :to="{ name: 'posts.create' }"
                                         class="nav-link">Nova Mensagem</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <router-view></router-view>
            </div>
        </main>
    </div>
</template>

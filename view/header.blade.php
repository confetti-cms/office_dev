@php($header = section('homepage/header')->label('Header'))
<header class="fixed z-50 bg-white/80 backdrop-blur border-b border-gray-100 dark:border-gray-700/30 dark:bg-gray-900/80 w-full">
            <nav
              id="navbar"
              class=" relative inset-x-0"
            >
              <div>
                <div
                  class="relative flex flex-wrap items-center justify-between"
                >
                  <div
                    class="relative z-20 flex w-full justify-between px-0 w-max"
                  >
                    <a href="/" aria-label="logo" class="flex items-center space-x-2 p-2">
                      <img src="/view/assets/confetti_cms_logo.png" class="h-10 pl-4">
                      <span class="hidden sm:block pt-2">{!! $header->text('title')->min(1)->max(20)->default('Confetti CMS') !!}</span>
                    </a>
                  </div>
                  <div
                    id="layer"
                    aria-hidden="true"
                    class="fixed inset-0 z-10 h-screen w-screen origin-bottom scale-y-0 bg-white/70 backdrop-blur-2xl transition duration-500 dark:bg-gray-900/70"
                  ></div>
                  <div
                    id="navlinks"
                    class="absolute left-0 z-20 origin-top-right translate-y-1 scale-90 justify-end gap-6 rounded-3xl border border-gray-100 bg-white p-8 opacity-0 shadow-2xl shadow-gray-600/10 transition-all duration-300 dark:border-gray-700 dark:bg-gray-800 dark:shadow-none visible relative flex w-auto translate-y-0 scale-100 flex-row items-center gap-0 border-none bg-transparent p-0 opacity-100 shadow-none peer-checked:translate-y-0 dark:bg-transparent"
                  >
                    <div
                      class="text-gray-600 dark:text-gray-300"
                    >
                      <ul
                        class="text-base font-medium tracking-wide flex space-y-0 text-sm"
                      >
                        <li>
                          <a
                            href="/pricing"
                            class="block transition hover:text-primary dark:hover:text-primaryLight px-4"
                          >
                            <span>Pricing</span>
                          </a>
                        </li>
                        <li>
                          <a
                            href="/pricing"
                            class="block transition hover:text-primary dark:hover:text-primaryLight px-4"
                          >
                            <span>Docs</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                    @guest
                    <div
                      class="ml-2 mr-4 flex w-full flex-col space-y-2 border-primary/10 dark:border-gray-700"
                    >
                      <a
                        href="https://tally.so/r/mK5kgK"
                        class="relative ml-auto flex h-9 w-full items-center justify-center before:absolute before:inset-0 before:rounded-full before:bg-primary before:transition-transform before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95 dark:before:border-gray-700 dark:before:bg-primaryLight px-4"
                      >
                        <span
                          class="relative text-sm font-semibold text-white dark:text-gray-900"
                          >
                            Join<span class="hidden sm:contents"> the waiting list</span>
                        </span
                        >
                      </a>
                    </div>
                    @endguest
                  </div>
                </div>
              </div>
            </nav>
          </header>

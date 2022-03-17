cmake_minimum_required(VERSION 3.21)
project(PlantGraph)

find_package(Boost COMPONENTS system filesystem REQUIRED)
set(CMAKE_CXX_STANDARD 17)

add_executable(PlantGraph src/main.cpp)
target_link_libraries(PlantGraph ${Boost_FILESYSTEM_LIBRARY}  ${Boost_SYSTEM_LIBRARY})

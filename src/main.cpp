#include <iostream>
#include <utility>
#include <set>

#include <boost/filesystem.hpp>
#include <boost/filesystem/operations.hpp>

using namespace std::string_literals;


struct PhpClass {
    std::string name_;
    std::string namespace_;
    std::set<std::string> relations_;
    std::string GetFullName() const {
        return namespace_ + '\\' + name_;
    }

    bool operator<(const PhpClass& other) const {
        return this->GetFullName() < other.GetFullName();
    }
};


std::vector<boost::filesystem::path> LoadFiles(std::string&& entry_point, std::string&& extension) {
    std::vector<boost::filesystem::path> results;

    boost::filesystem::recursive_directory_iterator begin(entry_point);
    boost::filesystem::recursive_directory_iterator end;

    for (; begin != end; ++begin) {
        if (is_regular_file(begin->status()) && boost::filesystem::extension(*begin) == extension) {
            results.push_back(begin->path());
        }
    }

    return results;
}

std::istream& operator>>(std::istream& is, PhpClass& phpClass) {
    std::string token;

    while (is >> token) {
        if (token == "namespace") {
            is >> phpClass.namespace_;
            phpClass.namespace_.pop_back();
        } else if (token == "use") {
            is >> token;
            if (token.back() == ';')
                token.pop_back();
            phpClass.relations_.insert(std::move(token));
        } else if (token == "class") {
            is >> phpClass.name_;
        }
    }
    return is;
}

std::ostream& operator<<(std::ostream& os, const PhpClass& phpClass) {
    os << "{ PhpClass: " << phpClass.GetFullName() << " }";

    return os;
}

void SaveToFile(const std::string& filename, const std::map<std::string, PhpClass>& classes, const std::string& kClassName) {
    std::ofstream out(filename);

    out << "@startuml" << std::endl << std::endl;
    for (const auto& [kName, kSymbol] : classes) {
        if (kSymbol.relations_.count(kClassName)) {
            out << "class " << kSymbol.GetFullName() << std::endl;
            for (const auto& link : kSymbol.relations_) {
                out << kName << " --> " << link << std::endl;
            }
            out << std::endl;
        }
    }
    out << "@enduml" << std::endl;
}


int main() {
    const std::string kClassName = "App\\Entity\\Acquisition"s;
    auto files = LoadFiles("/Users/echistiakov/citymobil/leadsflow/src"s, ".php");
    std::map<std::string, PhpClass> classes;
    for (const auto& path : files) {
        std::ifstream input(path.string());
        PhpClass php;
        input >> php;
        classes[php.GetFullName()] = php;
    }
    SaveToFile("leadsflow.phuml", classes, kClassName);
}
